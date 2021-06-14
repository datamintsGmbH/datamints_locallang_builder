<template><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" :width="width" :height="height"><g><path d="M48,40c0,1.105-0.895,2-2,2H2c-1.105,0-2-0.895-2-2V30h48V40z"></path> <rect y="18" fill="#E6E6E6" width="48" height="12"></rect> <path fill="#CC162C" d="M48,18H0V8c0-1.105,0.895-2,2-2h44c1.105,0,2,0.895,2,2V18z"></path> <rect x="12" y="22" fill="#22B573" width="2" height="6"></rect> <rect x="8" y="22" fill="#22B573" width="6" height="2"></rect> <rect x="8" y="26" fill="#22B573" width="8" height="2"></rect> <rect x="10" y="20" fill="#22B573" width="2" height="4"></rect> <polygon fill="#22B573" points="20,26 20,20 18,20 18,26 18,28 20,28 22,28 22,26 "></polygon> <rect x="6" y="22" fill="#22B573" width="2" height="2"></rect> <polygon fill="#22B573" points="38,20 36,20 36,26 34,26 34,20 32,20 32,26 30,26 30,22 28,22 28,26 26,26 26,28 28,28 30,28 32,28 34,28 36,28 38,28 40,28 40,26 38,26 "></polygon> <rect x="40" y="22" fill="#22B573" width="2" height="2"></rect></g></svg></template>

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