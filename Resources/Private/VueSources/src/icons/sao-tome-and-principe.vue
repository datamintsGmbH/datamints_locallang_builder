<template><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" :width="width" :height="height"><g><path fill="#17AC4E" d="M48,16H12L2,6h44c1.105,0,2,0.895,2,2V16z"></path> <polygon fill="#FFDB0C" points="48,32 12,32 20,24 12,16 48,16 "></polygon> <path fill="#17AC4E" d="M48,40c0,1.105-0.895,2-2,2H2l10-10h36V40z"></path> <path fill="#D91E2F" d="M2,6C0.896,6,0,6.895,0,8v16v16c0,1.105,0.896,2,2,2l18-18L2,6z"></path> <path fill="#424041" d="M30.369,22.543h-2.948l-1.236-2.684l-1.237,2.684H22l2.153,2.227L23.357,28l2.827-1.605L29.012,28 l-0.796-3.23L30.369,22.543z"></path> <path fill="#424041" d="M42.369,22.543h-2.948l-1.236-2.684l-1.237,2.684H34l2.153,2.227L35.357,28l2.827-1.605L41.012,28 l-0.796-3.23L42.369,22.543z"></path></g></svg></template>

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