import { useNavigate, useLocation } from "../../imports";

const useNavigation = ({ navigate }) => {
  const Navigate = useNavigate();
  const Location = useLocation();

  const HandleNavigate = (element) => {
    Navigate(`${navigate}`, {state : {element}});
  };

  return { HandleNavigate, Location};
};

export default useNavigation;
