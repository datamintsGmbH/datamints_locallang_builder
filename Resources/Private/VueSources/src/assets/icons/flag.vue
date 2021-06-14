<template><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" :width="width" :height="height"><g :fill="_secondaryfill" :stroke="_secondaryfill"><polyline points="3.5 1.5 13.5 1.5 13.5 9.5 3.5 9.5" fill="none" stroke-linecap="round" stroke-linejoin="round" :stroke="fill"></polyline> <line x1="3.5" y1="0.5" x2="3.5" y2="15.5" fill="none" stroke-linecap="round" stroke-linejoin="round" :stroke="_secondaryfill"></line></g></svg></template>

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