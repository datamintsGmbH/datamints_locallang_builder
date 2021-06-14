<template><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" :width="width" :height="height"><g><path fill="#E6E6E6" d="M48,8c0-1.105-0.895-2-2-2H20v20H0v14c0,1.105,0.895,2,2,2h44c1.105,0,2-0.895,2-2V8z"></path> <rect x="20" y="10" fill="#DA2728" width="28" height="4"></rect> <rect x="20" y="18" fill="#DA2728" width="28" height="4"></rect> <polygon fill="#DA2728" points="0,26 0,30 48,30 48,26 20,26 "></polygon> <rect y="34" fill="#DA2728" width="48" height="4"></rect> <path fill="#073AAA" d="M20,26H0V8c0-1.105,0.895-2,2-2h18V26z"></path> <rect x="12" y="14" fill="#FED02F" width="4" height="4"></rect> <path fill="#FED02F" d="M6.4,16c0-2.234,1.533-4.094,3.6-4.631c-0.385-0.1-0.783-0.17-1.199-0.17C6.148,11.199,4,13.35,4,16 s2.148,4.801,4.801,4.801c0.416,0,0.814-0.07,1.199-0.17C7.934,20.094,6.4,18.234,6.4,16z"></path></g></svg></template>

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