<template><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" :width="width" :height="height"><g><path fill="#1799B3" d="M48,40c0,1.105-0.895,2-2,2H2c-1.105,0-2-0.895-2-2v-2l48-8V40z"></path> <polygon fill="#D1142A" points="48,30 0,38 0,10 48,18 "></polygon> <path fill="#439845" d="M48,18L0,10V8c0-1.105,0.895-2,2-2h44c1.105,0,2,0.895,2,2V18z"></path> <path fill="#FFFF00" d="M10,16c-3.859,0-7,3.141-7,7s3.141,7,7,7c3.859,0,7-3.141,7-7S13.859,16,10,16z M10,28c-2.758,0-5-2.242-5-5 s2.242-5,5-5c2.758,0,5,2.242,5,5S12.758,28,10,28z"></path></g></svg></template>

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