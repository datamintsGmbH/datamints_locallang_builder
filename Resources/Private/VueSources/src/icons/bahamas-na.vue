<template><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" :width="width" :height="height"><g><path fill="#00A6D3" d="M48,18H14L2,6h44c1.105,0,2,0.895,2,2V18z"></path> <polygon fill="#F6E04E" points="48,30 14,30 20,24 14,18 48,18 "></polygon> <path fill="#00A6D3" d="M48,40c0,1.105-0.895,2-2,2H2l12-12h34V40z"></path> <path d="M2,6C0.896,6,0,6.895,0,8v16v16c0,1.105,0.896,2,2,2l18-18L2,6z"></path></g></svg></template>

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