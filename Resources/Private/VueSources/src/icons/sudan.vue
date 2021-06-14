<template><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" :width="width" :height="height"><g><path fill="#0EA651" d="M2,6C0.896,6,0,6.895,0,8v16v16c0,1.105,0.896,2,2,2l18-18L2,6z"></path> <path fill="#2D2D2D" d="M48,40c0,1.105-0.895,2-2,2H2l12-12h34V40z"></path> <polygon fill="#E6E6E6" points="48,30 14,30 20,24 14,18 48,18 "></polygon> <path fill="#D81D38" d="M48,18H14L2,6h44c1.105,0,2,0.895,2,2V18z"></path></g></svg></template>

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