<template><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" :width="width" :height="height"><g><path fill="#009900" d="M48,40c0,1.105-0.895,2-2,2H10V32h38V40z"></path> <path fill="#CC0001" d="M48,32H10V6h36c1.105,0,2,0.895,2,2V32z"></path> <path fill="#CC0001" d="M8,42H2c-1.105,0-2-0.895-2-2V8c0-1.105,0.895-2,2-2h6V42z"></path> <rect x="8" y="6" fill="#E6E6E6" width="2" height="36"></rect> <rect x="4" y="8" fill="#E6E6E6" width="4" height="2"></rect> <rect y="10" fill="#E6E6E6" width="4" height="2"></rect> <rect x="4" y="12" fill="#E6E6E6" width="4" height="2"></rect> <rect y="14" fill="#E6E6E6" width="4" height="2"></rect> <rect x="4" y="16" fill="#E6E6E6" width="4" height="2"></rect> <rect y="18" fill="#E6E6E6" width="4" height="2"></rect> <rect x="4" y="20" fill="#E6E6E6" width="4" height="2"></rect> <rect y="22" fill="#E6E6E6" width="4" height="2"></rect> <rect x="4" y="24" fill="#E6E6E6" width="4" height="2"></rect> <rect y="26" fill="#E6E6E6" width="4" height="2"></rect> <rect x="4" y="28" fill="#E6E6E6" width="4" height="2"></rect> <rect y="30" fill="#E6E6E6" width="4" height="2"></rect> <rect x="4" y="32" fill="#E6E6E6" width="4" height="2"></rect> <rect y="34" fill="#E6E6E6" width="4" height="2"></rect> <rect x="4" y="36" fill="#E6E6E6" width="4" height="2"></rect> <rect y="38" fill="#E6E6E6" width="4" height="2"></rect></g></svg></template>

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