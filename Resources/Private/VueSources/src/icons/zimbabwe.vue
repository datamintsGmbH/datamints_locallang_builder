<template><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" :width="width" :height="height"><g><path fill="#3C9038" d="M48,40c0,1.105-0.895,2-2,2H2l4-4h42V40z"></path> <polygon fill="#F8D406" points="6,38 48,38 48,32 12,32 "></polygon> <polygon fill="#D12325" points="48,32 12,32 18,26 48,26 "></polygon> <polygon fill="#D12325" points="18,22 48,22 48,16 12,16 "></polygon> <path fill="#3C9038" d="M6,10h42V8c0-1.105-0.895-2-2-2H2L6,10z"></path> <polygon fill="#F8D406" points="48,16 12,16 6,10 48,10 "></polygon> <polygon fill="#443A17" points="48,26 18,26 20,24 18,22 48,22 "></polygon> <path fill="#E6E6E6" d="M2,6C0.895,6,0,6.895,0,8v16v16c0,1.105,0.895,2,2,2l18-18L2,6z"></path> <path fill="#D12325" d="M14,21.525h-3.873L8.506,18l-1.625,3.525H3.012l2.828,2.918l-1.047,4.244l3.713-2.108l3.713,2.108 l-1.047-4.244L14,21.525z"></path> <circle fill="#FFFF00" cx="8.506" cy="23.719" r="3.406"></circle></g></svg></template>

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