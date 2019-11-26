export default function truncate(value)
{
    // Strip html tags and white spaces.
    value = (value.replace(/(<([^>]+)>)|&nbsp;/ig, ""));

    return (value.substr(0, 60)) ;
}