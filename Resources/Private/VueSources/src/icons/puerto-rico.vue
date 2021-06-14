<template><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" :width="width" :height="height"><g><polygon fill="#E6E6E6" points="16,28 8,36 48,36 48,28 "></polygon> <polygon fill="#E6E6E6" points="8,12 16,20 48,20 48,12 "></polygon> <path fill="#FF0000" d="M46,6H2l6,6h40V8C48,6.896,47.104,6,46,6z"></path> <polygon fill="#FF0000" points="16,20 20,24 16,28 48,28 48,20 "></polygon> <path fill="#FF0000" d="M8,36l-6,6h44c1.104,0,2-0.896,2-2v-4H8z"></path> <path fill="#0051F9" d="M2,6C0.896,6,0,6.895,0,8v16v16c0,1.105,0.896,2,2,2l18-18L2,6z"></path> <path fill="#FFFFFF" d="M12.367,22.543H9.42l-1.236-2.684l-1.238,2.684H4l2.152,2.227L5.355,28l2.828-1.605L11.012,28l-0.797-3.23 L12.367,22.543z"></path> </g></svg></template>

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