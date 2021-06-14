<template><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" :width="width" :height="height"><g><path fill="#DB000B" d="M48,40c0,1.105-0.895,2-2,2H2c-1.105,0-2-0.895-2-2v-8h48V40z"></path> <path fill="#E6E6E6" d="M48,32H0V8c0-1.105,0.895-2,2-2h44c1.105,0,2,0.895,2,2V32z"></path> <polygon fill="#FF0000" points="34,18 36,18 36,16 28,16 28,18 30,18 30,24 26,24 26,14 28,14 28,12 20,12 20,14 22,14 22,24 18,24 18,18 20,18 20,16 12,16 12,18 14,18 14,24 14,28 12,28 12,30 36,30 36,28 34,28 34,24 "></polygon> <rect x="22" y="26" fill="#1E1E1E" width="4" height="4"></rect> <rect x="22" y="32" fill="#F6D800" width="4" height="6"></rect></g></svg></template>

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