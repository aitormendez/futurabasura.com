import Edit from './edit';

const CustomIcon = (
  <svg
    width="24"
    height="18"
    viewBox="0 0 24 18"
    fill="none"
    xmlns="http://www.w3.org/2000/svg"
  >
    <path
      fillRule="evenodd"
      clipRule="evenodd"
      d="M0 0H24V2H20V4H24V7H17V16H24V18H0V16H6V7H0V4H4V2H0V0ZM6 2H18V4H6V2ZM15 7H8V16H15V7Z"
      fill="black"
    />
  </svg>
);

export default {
  name: `sage/slider`,
  title: `Slider`,
  icon: CustomIcon,
  category: `fb`,
  attributes: {
    title: {
      type: 'string',
      default: 'Test text',
    },
  },
  supports: {
    align: ['wide', 'full'],
    color: true,
    typography: {
      fontSize: true,
      lineHeight: true,
      textAlign: true,
      __experimentalFontFamily: true,
    },
  },
  edit: Edit,
  save: () => null,
};
