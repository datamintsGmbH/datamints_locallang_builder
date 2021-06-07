<?php

declare(strict_types=1);

namespace Datamints\DatamintsLocallangBuilder\Mvc\View;


class JsonView extends \TYPO3\CMS\Extbase\Mvc\View\JsonView
{
    use \Datamints\DatamintsLocallangBuilder\Services\Traits\CachesServiceTrait;

    /**
     * Nur hier definierte Variablen werden in der Response gerendert
     * Jede API Response sollte im Endeffekt gleich aufgebaut sein, deshalb hier zentral definiert
     *
     * @var string[]
     */
    protected $variablesToRender = [
        'status',
        'message',
        'data',
        'requestTime',
        'return',
        'type',
    ];


    /**
     * Transforms the value view variable to a serializable
     * array representation using a YAML view configuration and JSON encodes
     * the result.
     *
     * Schaut zusätzlich im data-object, ob Permissions vorliegen und diese Felder manipuliert werden müssten, sodass
     * nur lesbare Properties aus "data" ausgegeben werden
     *
     * @return string
     */
    public function render(): string
    {
        $data = $this->variables['data'];
        return parent::render();
    }


    /**
     * TODO - Doku fehlt
     *
     * @param array $paths
     *
     * @return array
     * @see convertPathToDisplayConfiguration
     */
    protected function convertPathsToDisplayConfiguration(array $paths): array
    {
        $result = [];

        foreach ($paths as $readableProperty) {
            $result = array_merge_recursive($result, $this->convertPathToDisplayConfiguration($readableProperty));
        }

        // Nichts ausgeben, wenn nichts erlaubt ist
        if(empty($result)) {
            $result['_only'] = [];
        }

        return $result;
    }

    /**
     * Konvertiert eine Simple Pfad angabe, wie wir sie momentan für die Lese-Berechtigungen verwenden, zu einem
     * JsonView Konfigurations-Array Beispiel: usergroup.*.title
     *
     * Muss zu folgendem Array führen (damit letztendlich der title von allen usergroups ausgegeben wird):
     *
     * '_only' => [
     *    'uid',
     *    'username',
     *    'usergroup'
     * ],
     * '_descend' => [
     *    'usergroup' => [
     *        '_descendAll' => [
     *            '_only' => [
     *                'uid',
     *                'title'
     *            ]
     *        ]
     *    ]
     * ]
     *
     * @param string $path
     *
     * @return array
     */
    protected function convertPathToDisplayConfiguration(string $path): array
    {
        $pathSegments = explode('.', $path);

        $tempResult = [];

        foreach (array_reverse($pathSegments) as $index => $segment) {
            $previousResult = $tempResult;
            $tempResult = [];

            if($index === 0) {
                $tempResult['_only'] = [$segment];
                continue;
            }

            if($index === count($pathSegments) - 1) {
                $tempResult['_only'] = [$segment];
            }

            if($segment === '*') {
                $tempResult['_descendAll'] = $previousResult;
            } else {
                $tempResult['_descend'][$segment] = $previousResult;
            }
        }

        return $tempResult;
    }
}
