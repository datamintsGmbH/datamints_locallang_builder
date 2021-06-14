<template><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" :width="width" :height="height"><g><rect y="6" width="48" height="36" rx="2" ry="2" fill="#2d6943"></rect> <rect x="19" y="6" width="3" height="36" fill="#f8d34c"></rect> <rect x="22" y="6" width="4" height="36" fill="#010404"></rect> <rect x="26" y="6" width="3" height="36" fill="#fff"></rect> <rect x="22.5" y="-3.5" width="3" height="48" transform="translate(44.5 -3.5) rotate(90)" fill="#f8d34c"></rect> <rect x="22" width="4" height="48" transform="translate(48 0) rotate(90)" fill="#010404"></rect> <rect x="22.5" y="3.5" width="3" height="48" transform="translate(51.5 3.5) rotate(90)" fill="#fff"></rect> <circle cx="24" cy="24" r="9" fill="#c5323a"></circle></g></svg></template>

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