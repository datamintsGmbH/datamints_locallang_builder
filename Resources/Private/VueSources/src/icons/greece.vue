<template><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" :width="width" :height="height"><g><path fill="#010080" d="M48,40c0,1.105-0.895,2-2,2H2c-1.105,0-2-0.895-2-2V8c0-1.105,0.895-2,2-2h44c1.105,0,2,0.895,2,2V40z"></path> <rect x="20" y="10" fill="#E6E6E6" width="28" height="4"></rect> <rect x="20" y="18" fill="#E6E6E6" width="28" height="4"></rect> <polygon fill="#E6E6E6" points="12,14 12,6 8,6 8,14 0,14 0,18 8,18 8,26 0,26 0,30 48,30 48,26 12,26 12,18 20,18 20,14 "></polygon> <rect y="34" fill="#E6E6E6" width="48" height="4"></rect></g></svg></template>

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