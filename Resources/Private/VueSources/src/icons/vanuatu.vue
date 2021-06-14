<template><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" :width="width" :height="height"><g><polygon fill="#F8C90A" points="20,22 0,10 0,14 16,24 0,34 0,38 20,26 48,26 48,22 "></polygon> <polygon points="0,14 0,18 0,30 0,34 16,24 "></polygon> <path fill="#F80000" d="M2,6C0.895,6,0,6.895,0,8v2l20,12h28V10V8c0-1.105-0.895-2-2-2H2z"></path> <path fill="#088537" d="M2,42c-1.105,0-2-0.895-2-2v-2l20-12h28v12v2c0,1.105-0.895,2-2,2H2z"></path> <path fill="#F8C90A" d="M6,22c-1.104,0-2,0.896-2,2s0.896,2,2,2s2-0.896,2-2S7.104,22,6,22z M6,25c-0.553,0-1-0.447-1-1s0.447-1,1-1 s1,0.447,1,1S6.553,25,6,25z"></path></g></svg></template>

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