<template><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" :width="width" :height="height"><g><path fill="#E6E6E6" d="M48,40c0,1.105-0.895,2-2,2H2c-1.105,0-2-0.895-2-2V8c0-1.105,0.895-2,2-2h44c1.105,0,2,0.895,2,2V40z"></path> <rect x="22" y="6" fill="#E4122D" width="4" height="36"></rect> <rect y="22" fill="#E4122D" width="48" height="4"></rect> <polygon fill="#E2C914" points="32,22 26,22 26,16 28,14 20,14 22,16 22,22 16,22 14,20 14,28 16,26 22,26 22,32 20,34 28,34 26,32 26,26 32,26 34,28 34,20 "></polygon></g></svg></template>

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