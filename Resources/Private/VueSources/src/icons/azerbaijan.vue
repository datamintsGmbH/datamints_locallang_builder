<template><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" :width="width" :height="height"><g><path fill="#1799C1" d="M48,18H0V8c0-1.105,0.895-2,2-2h44c1.105,0,2,0.895,2,2V18z"></path> <rect y="18" fill="#DD0C39" width="48" height="12"></rect> <path fill="#19AD67" d="M48,40c0,1.105-0.895,2-2,2H2c-1.105,0-2-0.895-2-2V30h48V40z"></path> <path fill="#FFFFFF" d="M26,28c-2.209,0-4-1.791-4-4s1.791-4,4-4c0.165,0,0.322,0.029,0.482,0.049C25.384,18.803,23.793,18,22,18 c-3.313,0-6,2.688-6,6c0,3.313,2.687,6,6,6c1.793,0,3.384-0.803,4.482-2.049C26.322,27.971,26.165,28,26,28z"></path> <polygon fill="#FFFFFF" points="31.357,22.643 31.235,23.721 32,24.482 31.084,25.059 30.964,26.133 29.941,25.777 29.025,26.354 28.669,25.33 27.647,24.973 28.224,24.059 27.865,23.037 28.94,22.914 29.517,22 30.281,22.766 "></polygon></g></svg></template>

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