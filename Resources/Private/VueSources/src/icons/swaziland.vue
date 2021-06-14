<template><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" :width="width" :height="height"><g><path fill="#3C5BBC" d="M48,14H0V8c0-1.105,0.895-2,2-2h44c1.105,0,2,0.895,2,2V14z"></path> <path fill="#3C5BBC" d="M48,40c0,1.105-0.895,2-2,2H2c-1.105,0-2-0.895-2-2v-6h48V40z"></path> <rect y="16" fill="#BD1D27" width="48" height="16"></rect> <rect y="14" fill="#FFDB00" width="48" height="2"></rect> <rect y="32" fill="#FFDB00" width="48" height="2"></rect> <rect x="10" y="26" fill="#FFDB00" width="12" height="2"></rect> <rect x="10" y="20" fill="#FFDB00" width="12" height="2"></rect> <rect x="26" y="26" fill="#FFDB00" width="12" height="2"></rect> <rect x="26" y="20" fill="#FFDB00" width="12" height="2"></rect> <path fill="#3C3C3C" d="M18,24c0,3.314,2.687,6,6,6V18C20.687,18,18,20.686,18,24z"></path> <path fill="#FFFFFF" d="M30,24c0,3.314-2.687,6-6,6V18C27.313,18,30,20.686,30,24z"></path></g></svg></template>

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