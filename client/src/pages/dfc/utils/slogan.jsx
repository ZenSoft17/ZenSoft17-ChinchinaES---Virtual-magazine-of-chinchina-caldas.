import { Number_Sign, Provider_Context, useContext, useMathRamdon } from "../../../imports";
import "../../../assets/styles/dfc/components/slogan.css";

const Slogans = () => {
  const { exports } = useContext(Provider_Context);
  const hashtags = exports.DataHashtags.hashtags;
  const { number } = useMathRamdon({ length: hashtags && hashtags.length > 0 ? hashtags.length : 0 });
  console.log(number);
  
  return (
    <span className="span-slogan-dfc">
      <img
        src={Number_Sign}
        className="image-slogan-dfc"
        alt="Número del eslogan"
        loading="lazy"
      />
      {hashtags && hashtags.length > 0 ? hashtags[number].hashtag : "no hay datos"}
    </span>
  );
};

export default Slogans;
