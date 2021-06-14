<template><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" :width="width" :height="height"><g><path fill="#1D266B" d="M48,40c0,1.105-0.895,2-2,2H2c-1.105,0-2-0.895-2-2v-4h48V40z"></path> <rect y="18" fill="#EA212D" width="48" height="12"></rect> <path fill="#1D266B" d="M48,12H0V8c0-1.105,0.895-2,2-2h44c1.105,0,2,0.895,2,2V12z"></path> <rect y="30" fill="#E6E6E6" width="48" height="6"></rect> <rect y="12" fill="#E6E6E6" width="48" height="6"></rect> <path fill="#FFFFFF" d="M14,20c-2.209,0-4,1.791-4,4s1.791,4,4,4c2.209,0,4-1.791,4-4S16.209,20,14,20z M14,26c-1.105,0-2-0.895-2-2 c0-1.105,0.895-2,2-2c1.105,0,2,0.895,2,2C16,25.105,15.105,26,14,26z"></path></g></svg></template>

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