<template><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" :width="width" :height="height"><g><path fill="#CC162C" d="M48,40c0,1.105-0.895,2-2,2H2c-1.105,0-2-0.895-2-2V8c0-1.105,0.895-2,2-2h44c1.105,0,2,0.895,2,2V40z"></path> <circle fill="#FDE233" cx="24" cy="24" r="6"></circle> <path fill="#FDE233" d="M24,12c-6.627,0-12,5.371-12,12s5.373,12,12,12s12-5.371,12-12S30.627,12,24,12z M24,34 c-5.522,0-10-4.477-10-10s4.478-10,10-10c5.522,0,10,4.477,10,10S29.522,34,24,34z"></path></g></svg></template>

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