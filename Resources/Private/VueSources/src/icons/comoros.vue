<template><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" :width="width" :height="height"><g><path fill="#FFC615" d="M48,14H10L2,6h44c1.105,0,2,0.895,2,2V14z"></path> <path fill="#4A73A9" d="M48,34H10l-8,8h44c1.105,0,2-0.895,2-2V34z"></path> <polygon fill="#E6E6E6" points="10,14 48,14 48,24 20,24 "></polygon> <polygon fill="#D52027" points="10,34 48,34 48,24 20,24 "></polygon> <path fill="#339241" d="M2,6C0.895,6,0,6.895,0,8v16v16c0,1.105,0.895,2,2,2l18-18L2,6z"></path> <path fill="#FFFFFF" d="M6,24c0-2.609,1.674-4.807,4-5.633C9.371,18.145,8.705,18,8,18c-3.314,0-6,2.686-6,6s2.686,6,6,6 c0.705,0,1.371-0.145,2-0.367C7.674,28.807,6,26.609,6,24z"></path> <path fill="#FFFFFF" d="M13.043,23.557h-0.836l-0.279-0.697l-0.279,0.697h-0.836l0.557,0.697l-0.279,0.838l0.838-0.42l0.838,0.42 l-0.279-0.838L13.043,23.557z"></path> <path fill="#FFFFFF" d="M13.043,19.291h-0.836l-0.279-0.697l-0.279,0.697h-0.836l0.557,0.697l-0.279,0.838l0.838-0.42l0.838,0.42 l-0.279-0.838L13.043,19.291z"></path> <path fill="#FFFFFF" d="M13.043,27.871h-0.836l-0.279-0.697l-0.279,0.697h-0.836l0.557,0.699l-0.279,0.836l0.838-0.418l0.838,0.418 l-0.279-0.836L13.043,27.871z"></path></g></svg></template>

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