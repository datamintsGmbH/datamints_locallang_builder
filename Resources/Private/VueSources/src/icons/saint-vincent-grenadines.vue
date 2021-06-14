<template><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" :width="width" :height="height"><g><rect x="14" y="6" fill="#FFD10A" width="20" height="36"></rect> <path fill="#009E61" d="M48,40c0,1.105-0.895,2-2,2H34V6h12c1.105,0,2,0.895,2,2V40z"></path> <path fill="#0073C6" d="M14,42H2c-1.105,0-2-0.895-2-2V8c0-1.105,0.895-2,2-2h12V42z"></path> <rect x="21.642" y="24.31" transform="matrix(0.707 -0.7072 0.7072 0.707 -11.8273 24.7859)" fill="#009E61" width="4.714" height="4.714"></rect> <rect x="25.643" y="20.309" transform="matrix(0.7072 -0.707 0.707 0.7072 -7.8271 26.4322)" fill="#009E61" width="4.714" height="4.714"></rect> <rect x="17.643" y="20.309" transform="matrix(0.7072 -0.707 0.707 0.7072 -10.1694 20.7762)" fill="#009E61" width="4.714" height="4.714"></rect></g></svg></template>

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