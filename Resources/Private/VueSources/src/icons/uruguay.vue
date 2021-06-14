<template><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" :width="width" :height="height"><g><path fill="#E6E6E6" d="M48,8c0-1.105-0.895-2-2-2H18v20H0v14c0,1.105,0.895,2,2,2h44c1.105,0,2-0.895,2-2V8z"></path> <rect x="18" y="10" fill="#0437AC" width="30" height="4"></rect> <rect x="18" y="18" fill="#0437AC" width="30" height="4"></rect> <polygon fill="#0437AC" points="0,26 0,30 48,30 48,26 20,26 "></polygon> <rect y="34" fill="#0437AC" width="48" height="4"></rect> <path fill="#E6E6E6" d="M18,26H0V8c0-1.105,0.895-2,2-2h16V26z"></path> <circle fill="#B09405" cx="10" cy="16" r="4"></circle></g></svg></template>

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