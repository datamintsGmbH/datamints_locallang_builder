<template><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" :width="width" :height="height"><g><rect x="4" y="10" fill="#075641" width="8" height="28"></rect> <rect x="12" y="10" fill="#FC5C1F" width="8" height="28"></rect> <path fill="#D5AD3B" d="M48,8c0-1.105-0.895-2-2-2H2C0.895,6,0,6.895,0,8v32c0,1.105,0.895,2,2,2h44c1.105,0,2-0.895,2-2V8z M4,10 h16v28H4V10z M44,38H24V10h20V38z"></path> <rect x="24" y="10" fill="#8B222B" width="20" height="28"></rect> <rect x="26" y="12" fill="#D5AD3B" width="2" height="2"></rect> <rect x="40" y="12" fill="#D5AD3B" width="2" height="2"></rect> <rect x="26" y="34" fill="#D5AD3B" width="2" height="2"></rect> <rect x="40" y="34" fill="#D5AD3B" width="2" height="2"></rect> <path fill="#D5AD3B" d="M40,20v2h-8v-2c0-1.105-0.895-2-2-2h-2h-2c0,1.105,0.895,2,2,2v2v2h-2c0,1.105,0.895,2,2,2v2 c0,1.105,0.895,2,2,2v-2c0-1.105,0.895-2,2-2h6c1.105,0,2,0.895,2,2v2c1.105,0,2-0.895,2-2v-2v-4C42,20.895,41.105,20,40,20z"></path></g></svg></template>

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