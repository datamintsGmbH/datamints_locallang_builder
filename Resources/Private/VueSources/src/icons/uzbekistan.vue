<template><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" :width="width" :height="height"><g><path fill="#2AB342" d="M48,40c0,1.105-0.895,2-2,2H2c-1.105,0-2-0.895-2-2V30h48V40z"></path> <rect y="18" fill="#E6E6E6" width="48" height="12"></rect> <path fill="#1799B3" d="M48,18H0V8c0-1.105,0.895-2,2-2h44c1.105,0,2,0.895,2,2V18z"></path> <path fill="#FFFFFF" d="M10,8.141C9.678,8.059,9.348,8,9,8c-2.209,0-4,1.791-4,4s1.791,4,4,4c0.348,0,0.678-0.059,1-0.141 C8.277,15.412,7,13.861,7,12S8.277,8.588,10,8.141z"></path> <rect x="12" y="10" fill="#FFFFFF" width="2" height="2"></rect> <rect x="16" y="10" fill="#FFFFFF" width="2" height="2"></rect> <rect x="20" y="10" fill="#FFFFFF" width="2" height="2"></rect> <rect x="12" y="14" fill="#FFFFFF" width="2" height="2"></rect> <rect x="16" y="14" fill="#FFFFFF" width="2" height="2"></rect> <rect x="20" y="14" fill="#FFFFFF" width="2" height="2"></rect> <rect x="24" y="14" fill="#FFFFFF" width="2" height="2"></rect></g></svg></template>

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