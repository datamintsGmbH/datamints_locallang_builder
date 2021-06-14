<template><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" :width="width" :height="height"><g><path fill="#0D6849" d="M48,40c0,1.105-0.895,2-2,2H2c-1.105,0-2-0.895-2-2v-6h48V40z"></path> <rect y="18" fill="#1D266B" width="48" height="12"></rect> <path fill="#0D6849" d="M48,14H14V6h32c1.105,0,2,0.895,2,2V14z"></path> <rect y="28" fill="#F8D406" width="48" height="6"></rect> <rect x="14" y="14" fill="#F8D406" width="34" height="6"></rect> <rect y="20" fill="#0D6849" width="48" height="8"></rect> <path fill="#D52027" d="M14,20H0V8c0-1.105,0.895-2,2-2h12V20z"></path> <path fill="#FFFFFF" d="M10.754,12.305H8.291L7.26,10.063l-1.033,2.242H3.766l1.799,1.856l-0.666,2.699l2.361-1.34l2.361,1.34 L8.955,14.16L10.754,12.305z"></path></g></svg></template>

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