<template><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" :width="width" :height="height"><g><path fill="#B41F30" d="M48,8c0-1.105-0.895-2-2-2H20v20H0v14c0,1.105,0.895,2,2,2h44c1.105,0,2-0.895,2-2V8z"></path> <rect x="20" y="10" fill="#E6E6E6" width="28" height="4"></rect> <rect x="20" y="18" fill="#E6E6E6" width="28" height="4"></rect> <polygon fill="#E6E6E6" points="0,26 0,30 48,30 48,26 20,26 "></polygon> <rect y="34" fill="#E6E6E6" width="48" height="4"></rect> <path fill="#00256A" d="M20,26H0V8c0-1.105,0.895-2,2-2h18V26z"></path> <polygon fill="#FFFFFF" points="10,13.922 9.367,15.29 7.863,15.29 8.963,16.43 8.557,18.078 10,17.26 11.443,18.078 11.037,16.43 12.137,15.29 10.631,15.29 "></polygon> <polygon fill="#FFFFFF" points="5.107,9.029 4.475,10.397 2.971,10.397 4.07,11.537 3.664,13.185 5.107,12.367 6.551,13.185 6.144,11.537 7.244,10.397 5.738,10.397 "></polygon> <polygon fill="#FFFFFF" points="14.893,9.029 15.525,10.397 17.029,10.397 15.93,11.537 16.336,13.185 14.893,12.367 13.449,13.185 13.856,11.537 12.756,10.397 14.262,10.397 "></polygon> <polygon fill="#FFFFFF" points="5.107,22.971 4.475,21.603 2.971,21.603 4.07,20.463 3.664,18.815 5.107,19.633 6.551,18.815 6.144,20.463 7.244,21.603 5.738,21.603 "></polygon> <polygon fill="#FFFFFF" points="14.893,22.971 15.525,21.603 17.029,21.603 15.93,20.463 16.336,18.815 14.893,19.633 13.449,18.815 13.856,20.463 12.756,21.603 14.262,21.603 "></polygon></g></svg></template>

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