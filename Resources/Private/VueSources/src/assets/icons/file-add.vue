<template><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" :width="width" :height="height"><g :fill="_secondaryfill" :stroke="_secondaryfill"> <polyline points="15.5 10.5 15.5 14.5 0.5 14.5 0.5 10.5" fill="none" stroke-linecap="round" stroke-linejoin="round" :stroke="fill"></polyline> <line x1="8" y1="1.5" x2="8" y2="9.5" fill="none" stroke-linecap="round" stroke-linejoin="round" :stroke="_secondaryfill"></line> <line x1="12" y1="5.5" x2="4" y2="5.5" fill="none" stroke-linecap="round" stroke-linejoin="round" :stroke="_secondaryfill"></line> </g></svg></template>

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