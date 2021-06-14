<template><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" :width="width" :height="height"><g><rect x="14" y="6" fill="#FFC32A" width="20" height="36"></rect> <path fill="#08227F" d="M48,40c0,1.104-0.895,2-2,2H34V6h12c1.105,0,2,0.896,2,2V40z"></path> <path fill="#08227F" d="M14,42H2c-1.105,0-2-0.896-2-2V8c0-1.104,0.895-2,2-2h12V42z"></path> <polygon points="30,14 28,15.999 30,16 30,26 26,26 26,15.999 24,14 22,15.999 22,26 18,26 18,16 20,15.999 18,14 16,14 16,26 16,28 18,28 22,28 22,34 26,34 26,28 30,28 32,28 32,26 32,14 "></polygon></g></svg></template>

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