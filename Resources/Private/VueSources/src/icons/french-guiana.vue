<template><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" :width="width" :height="height"><g><path fill="#FDDF00" d="M0,8v32c0,1.105,0.895,2,2,2h44c0.584,0,1.104-0.254,1.47-0.653L0.53,6.653C0.204,7.009,0,7.479,0,8z"></path> <path fill="#008A2A" d="M48,8c0-1.105-0.895-2-2-2H2C1.416,6,0.896,6.254,0.53,6.653L47.47,41.347C47.796,40.991,48,40.521,48,40V8z "></path> <path fill="#DD0A07" d="M30.184,21.95h-4.356L24,17.984l-1.83,3.967h-4.353l3.181,3.291l-1.178,4.775L24,27.643l4.18,2.373 l-1.178-4.775L30.184,21.95z"></path></g></svg></template>

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