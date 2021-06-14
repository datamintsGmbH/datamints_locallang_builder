<template><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" :width="width" :height="height"><g><path fill="#E40A18" d="M48,40c0,1.105-0.895,2-2,2H2c-1.105,0-2-0.895-2-2V8c0-1.105,0.895-2,2-2h44c1.105,0,2,0.895,2,2V40z"></path> <path fill="#FFFFFF" d="M22,34c-5.523,0-10-4.478-10-10s4.477-10,10-10c1.256,0,2.445,0.258,3.553,0.681 C23.49,13.007,20.863,12,18,12c-6.627,0-12,5.373-12,12s5.373,12,12,12c2.863,0,5.49-1.007,7.553-2.681 C24.445,33.742,23.256,34,22,34z"></path> <path fill="#FFFFFF" d="M32.313,22.024l-1.846-4.004l-1.848,4.004h-4.207l3.076,3.182l-1.178,4.773l4.156-2.361l4.156,2.361 l-1.178-4.773l3.076-3.182H32.313z"></path></g></svg></template>

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