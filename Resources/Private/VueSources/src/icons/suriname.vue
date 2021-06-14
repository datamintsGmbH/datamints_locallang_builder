<template><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" :width="width" :height="height"><g><path fill="#3A7942" d="M48,18H0V8c0-1.105,0.895-2,2-2h44c1.105,0,2,0.895,2,2V18z"></path> <rect y="18" fill="#B5092F" width="48" height="12"></rect> <path fill="#3A7942" d="M48,40c0,1.105-0.895,2-2,2H2c-1.105,0-2-0.895-2-2V30h48V40z"></path> <path fill="#E7CE02" d="M28.248,22.406h-2.992L24,19.684l-1.256,2.723h-2.992l2.186,2.262l-0.809,3.279L24,26.316l2.871,1.631 l-0.808-3.279L28.248,22.406z"></path> <rect y="16" fill="#FFFFFF" width="48" height="2"></rect> <rect y="30" fill="#FFFFFF" width="48" height="2"></rect></g></svg></template>

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