<template><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" :width="width" :height="height"><g><path fill="#000105" d="M48,40c0,1.105-0.895,2-2,2H2c-1.105,0-2-0.895-2-2V30h48V40z"></path> <rect y="18" fill="#E6E6E6" width="48" height="12"></rect> <path fill="#CC162C" d="M48,18H0V8c0-1.105,0.895-2,2-2h44c1.105,0,2,0.895,2,2V18z"></path> <path fill="#0E783D" d="M20.313,22.613h-2.948l-1.236-2.684l-1.237,2.684h-2.947l2.153,2.227l-0.796,3.23l2.827-1.605l2.827,1.605 l-0.796-3.23L20.313,22.613z"></path> <path fill="#0E783D" d="M36,22.613h-2.948l-1.236-2.684l-1.237,2.684h-2.947l2.153,2.227l-0.796,3.23l2.827-1.605l2.827,1.605 l-0.796-3.23L36,22.613z"></path></g></svg></template>

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