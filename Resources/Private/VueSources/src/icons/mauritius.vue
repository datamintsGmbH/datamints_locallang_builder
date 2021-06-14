<template><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" :width="width" :height="height"><g><path fill="#0EA651" d="M48,40c0,1.105-0.895,2-2,2H2c-1.105,0-2-0.895-2-2v-6h48V40z"></path> <rect y="24" fill="#FFD505" width="48" height="10"></rect> <rect y="14" fill="#2B2B69" width="48" height="10"></rect> <path fill="#E52635" d="M48,14H0V8c0-1.105,0.895-2,2-2h44c1.105,0,2,0.895,2,2V14z"></path></g></svg></template>

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