import {
  useMemo,
  useGetAdvertising,
  useGetDfc,
  useGetHashtags,
  useGetImageBank,
  useGetRevista,
  useGetVideoBank
} from "../../imports";
import { Provider_Context } from "./provider";

const Global_Context = ({ children }) => {
  const keysAdvertising = useMemo(
    () => [
      { method: "get", key: "mark" },
      { method: "get", key: "contribuitor" },
    ],
    []
  );
  const keysDfc = useMemo(
    () => [
      { method: "get", key: "fair" },
      { method: "get", key: "introduction_information" },
      { method: "get", key: "event_information" },
      { method: "get", key: "projects_information" },
      { method: "get", key: "inscriptions_information" },
      { method: "get", key: "stripe_information" },
      { method: "get", key: "cast_hours" },
      { method: "get", key: "invited" },
      { method: "get", key: "themes" },
      { method: "get", key: "view" },
      { method: "get", key: "modalities" },
      { method: "get", key: "location" },
      { method: "get", key: "asist_hours" },
      { method: "get", key: "calendar_activities" },
      { method: "get", key: "certs" },
      { method: "get", key: "projects" },
    ],
    []
  );
  const keysHashtags = useMemo(() => [{ method: "get", key: "hashtags" }], []);
  const keysImageBank = useMemo(
    () => [{ method: "get", key: "image_bank" }],
    []
  );
  const keysVideoBank = useMemo(
    () => [{ method: "get", key: "video_bank" }],
    []
  );
  const keysRevista = useMemo(
    () => [
      { method: "get", key: "publications_all" },
      { method: "get", key: "special_category" },
    ],
    []
  );
  const {
    data: DataAdvertising,
    loading: LoadingAdvertising,
    error: ErrorAdvertising,
  } = useGetAdvertising({ keys: keysAdvertising });
  const {
    data: DataDfc,
    loading: LoadingDfc,
    error: ErrorDfc,
  } = useGetDfc({ keys: keysDfc });
  const {
    data: DataHashtags,
    loading: LoadingHashtags,
    error: ErrorHashtags,
  } = useGetHashtags({ keys: keysHashtags });
  const {
    data: DataImageBank,
    loading: LoadingImageBank,
    error: ErrorImageBank,
  } = useGetImageBank({ keys: keysImageBank });
  const {
    data: DataVideoBank,
    loading: LoadingVideoBank,
    error: ErrorVideoBank,
  } = useGetVideoBank({ keys: keysVideoBank });
  const {
    data: DataRevista,
    loading: LoadingRevista,
    error: ErrorRevista,
  } = useGetRevista({ keys: keysRevista });  

  const exports = {
    DataAdvertising,
    DataDfc,
    DataHashtags,
    DataImageBank,
    DataRevista,
    DataVideoBank
  };

  return (
    <Provider_Context.Provider value={{ exports }}>
      {children}
    </Provider_Context.Provider>
  );
};

export default Global_Context;
