<template><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" :width="width" :height="height"><g><path fill="#D12325" d="M48,40c0,1.105-0.895,2-2,2H2c-1.105,0-2-0.895-2-2v-4h48V40z"></path> <rect y="30" fill="#F8D406" width="48" height="6"></rect> <rect y="24" fill="#443A17" width="48" height="6"></rect> <rect y="18" fill="#D12325" width="48" height="6"></rect> <path fill="#443A17" d="M0,12h48V8c0-1.105-0.895-2-2-2H2C0.895,6,0,6.895,0,8V12z"></path> <rect y="12" fill="#F8D406" width="48" height="6"></rect> <circle fill="#FFFFFF" cx="24" cy="24" r="8"></circle> <path fill="#9BA099" d="M26,22h-4v-2h2v-2l-4,2v2v2c0,1.105,0.895,2,2,2v4l2-4l2,4v-4h2v-2C28,22.895,27.105,22,26,22z"></path></g></svg></template>

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