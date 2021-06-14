<template><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" :width="width" :height="height"><g><path fill="#73B1DF" d="M48,40c0,1.105-0.895,2-2,2H2c-1.105,0-2-0.895-2-2V8c0-1.105,0.895-2,2-2h44c1.105,0,2,0.895,2,2V40z"></path> <path fill="#F6D031" d="M28.184,14.545h-2.947L24,11.859l-1.238,2.686h-2.945l2.152,2.221L21.172,20L24,18.395L26.828,20 l-0.797-3.234L28.184,14.545z"></path> <path fill="#F6D031" d="M28.184,30.545h-2.947L24,27.859l-1.238,2.686h-2.945l2.152,2.221L21.172,36L24,34.395L26.828,36 l-0.797-3.234L28.184,30.545z"></path> <path fill="#F6D031" d="M18.367,22.686H15.42L14.184,20l-1.238,2.686H10l2.152,2.221l-0.797,3.234l2.828-1.605l2.828,1.605 l-0.797-3.234L18.367,22.686z"></path> <path fill="#F6D031" d="M38.367,22.686H35.42L34.184,20l-1.238,2.686H30l2.152,2.221l-0.797,3.234l2.828-1.605l2.828,1.605 l-0.797-3.234L38.367,22.686z"></path></g></svg></template>

<script>
export default {
	props: {
		width: {
			type: [Number, String],
			default: "100%"
		},
		height: {
			type: [Number, String],
			default: "100%"
		},
		fill: {
			type: String,
			default: "currentColor"
		},
		secondaryfill: {
			type: String
		}
	},
	computed: {
		_secondaryfill: function () {
			return this.secondaryfill || this.fill
		}
	}
}
</script>