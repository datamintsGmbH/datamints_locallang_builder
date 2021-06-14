<template><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" :width="width" :height="height"><g><path fill="#6F1B3D" d="M48,40c0,1.105-0.895,2-2,2H16V6h30c1.105,0,2,0.895,2,2V40z"></path> <path fill="#E6E6E6" d="M16,16l6-4l-6-4V6H2C0.895,6,0,6.895,0,8v32c0,1.105,0.895,2,2,2h14v-2l6-4l-6-4l6-4l-6-4l6-4L16,16z"></path></g></svg></template>

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