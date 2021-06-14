<template><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" :width="width" :height="height"><g><path fill="#108745" d="M48,18H0V8c0-1.105,0.895-2,2-2h44c1.105,0,2,0.895,2,2V18z"></path> <rect y="18" fill="#FDDC05" width="48" height="12"></rect> <path fill="#C60B1E" d="M48,40c0,1.105-0.895,2-2,2H2c-1.105,0-2-0.895-2-2V30h48V40z"></path> <circle fill="#20508E" cx="24" cy="24" r="10"></circle> <path fill="#FDDC05" d="M28.32,24l2.31-4h-4.619L24,16.516L21.988,20h-4.619l2.31,4l-2.31,4h4.619L24,31.484L26.012,28h4.619 L28.32,24z M23.143,26l-1.154-2l1.154-2h1.715l1.154,2l-1.154,2H23.143z"></path></g></svg></template>

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