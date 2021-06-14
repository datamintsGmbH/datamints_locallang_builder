<template><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" :width="width" :height="height"><g><path fill="#E6E6E6" d="M48,40c0,1.105-0.895,2-2,2H2c-1.105,0-2-0.895-2-2V8c0-1.105,0.895-2,2-2h44c1.105,0,2,0.895,2,2V40z"></path> <rect x="6" y="15" transform="matrix(0.5994 -0.8005 0.8005 0.5994 -8.4006 15.2155)" width="10" height="2.001"></rect> <rect x="36" y="11" transform="matrix(0.8 -0.6 0.6 0.8 -2.2 25.4)" width="2.001" height="10"></rect> <rect x="10" y="27" transform="matrix(0.8 -0.6 0.6 0.8 -17 13)" width="2.001" height="10"></rect> <rect x="32" y="31" transform="matrix(0.5994 -0.8005 0.8005 0.5994 -10.7917 42.4382)" width="10" height="2.001"></rect> <path fill="#053676" d="M34,24c0-2.762-2.238-5-5-5c-2.762,0-5,2.238-5,5s-2.238,5-5,5c-2.416,0-4.432-1.713-4.898-3.992 C14.613,30.051,18.822,34,24,34c5.178,0,9.387-3.949,9.898-8.992C33.965,24.682,34,24.346,34,24z"></path> <path fill="#BA0831" d="M24,14c-5.178,0-9.387,3.949-9.898,8.992C14.035,23.318,14,23.654,14,24c0,2.762,2.238,5,5,5 c2.762,0,5-2.238,5-5s2.238-5,5-5c2.416,0,4.432,1.713,4.898,3.992C33.387,17.949,29.178,14,24,14z"></path></g></svg></template>

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