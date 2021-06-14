<template><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" :width="width" :height="height"><g><path fill="#C60B1E" d="M48,40c0,1.105-0.895,2-2,2H2c-1.105,0-2-0.895-2-2V8c0-1.105,0.895-2,2-2h44c1.105,0,2,0.895,2,2V40z"></path> <polygon fill="#FFC300" points="26,42 24,26 22,42 "></polygon> <polygon fill="#FFC300" points="48,22 26,24 48,26 "></polygon> <polygon fill="#FFC300" points="0,26 22,24 0,22 "></polygon> <path fill="#FFC300" d="M48,8c0-1.105-0.896-2-2-2h-2L24,22L4,6H2C0.896,6,0,6.895,0,8v2l22,14L0,38v2c0,1.105,0.896,2,2,2h2l20-16 l20,16h2c1.104,0,2-0.895,2-2v-2L26,24l22-14V8z"></path> <polygon fill="#FFC300" points="22,6 24,22 26,6 "></polygon> <circle fill="#C60B1E" cx="24" cy="24" r="5"></circle> <circle fill="#FFC300" cx="24" cy="24" r="3"></circle></g></svg></template>

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