<template><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" :width="width" :height="height"><g><path fill="#0B6B37" d="M48,40c0,1.105-0.895,2-2,2H2c-1.105,0-2-0.895-2-2V8c0-1.105,0.895-2,2-2h44c1.105,0,2,0.895,2,2V40z"></path> <path fill="#FFFFFF" d="M38,14v2h-6v2h6v2h-6v2h6v2h-6v2h6v2h-8v-4v-2v-2h-2v2h-2v2h2v4h-4V18h-2v10h-2V18h-2v10h-2v-4v-2h-2h-4v-2 h6v-2h-6v-4H8v4v2v2v2v4v2h2h4h2h22h2v-2V18v-2v-2H38z M10,28v-4h4v4H10z"></path> <rect x="12" y="14" fill="#FFFFFF" width="2" height="2"></rect> <rect x="18" y="14" fill="#FFFFFF" width="6" height="2"></rect> <rect x="26" y="16" fill="#FFFFFF" width="4" height="2"></rect> <rect x="8" y="34" fill="#FFFFFF" width="32" height="2"></rect></g></svg></template>

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