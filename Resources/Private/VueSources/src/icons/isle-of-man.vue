<template><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" :width="width" :height="height"><g><path fill="#CE2029" d="M48,40c0,1.105-0.895,2-2,2H2c-1.105,0-2-0.895-2-2V8c0-1.105,0.895-2,2-2h44c1.105,0,2,0.895,2,2V40z"></path> <path fill="#FFFFFF" d="M31.795,25.236l-1.789-3.578c-0.493-0.988-1.695-1.389-2.683-0.895l-1.789,0.895l-1.789-3.578 c-0.494-0.987-1.695-1.388-2.684-0.894l-3.577,1.789l-1.789-3.577c-0.988,0.493-1.389,1.695-0.895,2.683l0.895,1.789 c0.494,0.988,1.695,1.389,2.684,0.894l3.577-1.789l1.789,3.578l-1.789,0.894c-0.987,0.494-1.388,1.695-0.894,2.683l1.789,3.578 l-3.577,1.789c0.493,0.987,1.695,1.388,2.683,0.895l1.789-0.895c0.988-0.494,1.389-1.695,0.894-2.684l-1.789-3.577l1.789-0.895 l1.789-0.895l1.789-0.894l1.788,3.577c0.494,0.988,1.695,1.389,2.684,0.895l1.789-0.895c0.987-0.493,1.388-1.695,0.894-2.683 L31.795,25.236z"></path></g></svg></template>

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