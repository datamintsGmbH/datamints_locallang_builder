<template><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" :width="width" :height="height"><g><path fill="#073CA5" d="M48,24H20L2,6h44c1.105,0,2,0.895,2,2V24z"></path> <path fill="#D7141A" d="M48,40c0,1.105-0.895,2-2,2H2l18-18h28V40z"></path> <path fill="#E6E6E6" d="M2,6C0.895,6,0,6.895,0,8v16v16c0,1.105,0.895,2,2,2l18-18L2,6z"></path> <path fill="#EFD358" d="M9,20c-2.209,0-4,1.791-4,4s1.791,4,4,4s4-1.791,4-4S11.209,20,9,20z"></path></g></svg></template>

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