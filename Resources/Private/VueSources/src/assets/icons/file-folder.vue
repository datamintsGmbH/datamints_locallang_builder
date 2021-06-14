<template><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" :width="width" :height="height"><g><path fill="#C7AA3D" d="M42,17H6V6c0-1.105,0.895-2,2-2h7l4,4h20c1.657,0,3,1.343,3,3V17z"></path> <path fill="#E6E6E6" d="M44,24H4V13c0-0.552,0.448-1,1-1h38c0.552,0,1,0.448,1,1V24z"></path> <path fill="#F9D44C" d="M41.143,45H6.857c-0.987,0-1.827-0.72-1.977-1.696l-3.692-24C1.002,18.093,1.939,17,3.165,17h41.67 c1.226,0,2.163,1.093,1.977,2.304l-3.692,24C42.969,44.28,42.13,45,41.143,45z"></path></g></svg></template>

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