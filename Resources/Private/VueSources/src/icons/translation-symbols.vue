<template><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" :width="width" :height="height"><g :fill="_secondaryfill" :stroke="_secondaryfill"><line x1="1.5" y1="2.5" x2="9.5" y2="2.5" fill="none" stroke-linecap="round" stroke-linejoin="round" :stroke="_secondaryfill"></line><line x1="5.5" y1="0.5" x2="5.5" y2="2.5" fill="none" stroke-linecap="round" stroke-linejoin="round" :stroke="_secondaryfill"></line><path d="M3.5,2.5A6.106,6.106,0,0,0,8,8.184" fill="none" stroke-linecap="round" stroke-linejoin="round" :stroke="_secondaryfill"></path><path d="M7.5,2.5c-.4,5.625-6,6-6,6" fill="none" stroke-linecap="round" stroke-linejoin="round" :stroke="_secondaryfill"></path><polyline points="8 14.5 11.5 6.5 15 14.5" fill="none" stroke-linecap="round" stroke-linejoin="round" :stroke="fill"></polyline><line x1="9.313" y1="11.5" x2="13.688" y2="11.5" fill="none" stroke-linecap="round" stroke-linejoin="round" :stroke="fill"></line></g></svg></template>

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