<template><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" :width="width" :height="height"><g><path fill="#3C3C3C" d="M48,18H0V8c0-1.105,0.895-2,2-2h44c1.105,0,2,0.895,2,2V18z"></path> <path fill="#0E6731" d="M48,40c0,1.105-0.895,2-2,2H2c-1.105,0-2-0.895-2-2V28h48V40z"></path> <rect y="18" fill="#BD1D27" width="48" height="12"></rect> <rect y="18" fill="#FFFFFF" width="48" height="2"></rect> <rect y="28" fill="#FFFFFF" width="48" height="2"></rect> <rect x="16.1" y="31.358" transform="matrix(0.8681 -0.4964 0.4964 0.8681 -13.5426 13.7494)" fill="#FFFFFF" width="6" height="2"></rect> <rect x="27.899" y="29.357" transform="matrix(0.4964 -0.8681 0.8681 0.4964 -13.5352 41.3841)" fill="#FFFFFF" width="2" height="6"></rect> <rect x="18.101" y="12.642" transform="matrix(0.4964 -0.8681 0.8681 0.4964 -3.9601 24.4589)" fill="#FFFFFF" width="2" height="6"></rect> <rect x="25.899" y="14.643" transform="matrix(0.8681 -0.4964 0.4964 0.8681 -3.953 16.4078)" fill="#FFFFFF" width="6" height="2"></rect> <polygon fill="#3C3C3C" points="28,16 24,14 20,16 20,32 24,34 28,32 "></polygon></g></svg></template>

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