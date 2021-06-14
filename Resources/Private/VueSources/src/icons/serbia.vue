<template><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" :width="width" :height="height"><g><path fill="#DD2026" d="M48,18H0V8c0-1.105,0.895-2,2-2h44c1.105,0,2,0.895,2,2V18z"></path> <rect y="18" fill="#233E85" width="48" height="12"></rect> <path fill="#E6E6E6" d="M48,40c0,1.105-0.895,2-2,2H2c-1.105,0-2-0.895-2-2V30h48V40z"></path> <polygon fill="#EE1E2E" points="18,18 6,18 6,30 12,34 18,30 "></polygon> <rect x="8" y="20" fill="#FFFFFF" width="8" height="6"></rect> <polygon fill="#FFFFFF" points="12,32 16,28 8,28 "></polygon> <polygon fill="#F5E303" points="8,14 8,16 10,16 10,18 14,18 14,16 16,16 16,14 "></polygon></g></svg></template>

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