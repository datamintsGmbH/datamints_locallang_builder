<template><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" :width="width" :height="height"><g stroke-miterlimit="10" :fill="_secondaryfill" :stroke="_secondaryfill"><line fill="none" stroke-linecap="round" stroke-linejoin="round" x1="4.5" y1="5.5" x2="11.5" y2="5.5" :stroke="_secondaryfill"></line> <line fill="none" stroke-linecap="round" stroke-linejoin="round" x1="4.5" y1="8.5" x2="11.5" y2="8.5" :stroke="_secondaryfill"></line> <path fill="none" stroke-linecap="round" stroke-linejoin="round" d="M15.5,7 c0-3.59-3.358-6.5-7.5-6.5S0.5,3.41,0.5,7s3.358,6.5,7.5,6.5c0.525,0,1.037-0.048,1.532-0.137L13.5,15.5v-4.091 C14.738,10.25,15.5,8.704,15.5,7z" :stroke="fill"></path> </g></svg></template>

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