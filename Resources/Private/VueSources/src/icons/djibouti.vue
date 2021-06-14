<template><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" :width="width" :height="height"><g><path fill="#15AB48" d="M48,40c0,1.105-0.895,2-2,2H2l20-18h26V40z"></path> <path fill="#6FB2DC" d="M48,24H22L2,6h44c1.105,0,2,0.895,2,2V24z"></path> <path fill="#E6E6E6" d="M2,6C0.895,6,0,6.895,0,8v16v16c0,1.105,0.895,2,2,2l20-18L2,6z"></path> <path fill="#D21F22" d="M14.369,22.543h-2.947l-1.238-2.684l-1.236,2.684H6l2.152,2.227L7.357,28l2.826-1.605L13.012,28l-0.797-3.23 L14.369,22.543z"></path></g></svg></template>

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