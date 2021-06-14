<template><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" :width="width" :height="height"><g><path fill="#E6E6E6" d="M0,40c0,1.105,0.895,2,2,2h44c1.105,0,2-0.895,2-2v-2H0V40z"></path> <path fill="#E6E6E6" d="M46,6H2C0.895,6,0,6.895,0,8v2h48V8C48,6.895,47.105,6,46,6z"></path> <rect y="10" fill="#0C72C4" width="48" height="8"></rect> <rect y="30" fill="#0C72C4" width="48" height="8"></rect> <rect y="18" fill="#E6E6E6" width="48" height="12"></rect> <polygon fill="#0C72C4" points="26.666,24 28,22 25.334,22 24,20 22.666,22 20,22 21.334,24 20,26 22.666,26 24,28 25.334,26 28,26 "></polygon></g></svg></template>

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