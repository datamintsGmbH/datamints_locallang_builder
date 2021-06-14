<template><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" :width="width" :height="height"><g><path fill="#2D2D2D" d="M48,18H14L2,6h44c1.105,0,2,0.895,2,2V18z"></path> <polygon fill="#E6E6E6" points="48,30 14,30 20,24 14,18 48,18 "></polygon> <path fill="#0EA651" d="M48,40c0,1.105-0.895,2-2,2H2l12-12h34V40z"></path> <path fill="#D81D38" d="M2,6C0.895,6,0,6.895,0,8v16v16c0,1.105,0.895,2,2,2l18-18L2,6z"></path> <polygon fill="#FFFFFF" points="8.359,19.527 9.33,21.984 11.855,21.211 10.539,23.502 12.719,24.996 10.107,25.395 10.299,28.029 8.359,26.236 6.42,28.029 6.611,25.395 4,24.996 6.18,23.502 4.863,21.211 7.389,21.984 "></polygon></g></svg></template>

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