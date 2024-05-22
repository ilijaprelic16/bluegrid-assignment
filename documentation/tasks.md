Create an endpoint /files using the Laravel framework, 
which should fetch data from the rest-test-eight.vercel.app/api/test endpoint and transform the result to meet the following form:

```json
{
    "<IP adress>": [
        {
            "<directory name>": [
                {
                    "<sub-directory name>": [
                        "<file name>",
                        "<file name>",
                        "<file name>"
                    ]
                },
                {
                    "<sub-directory name>": [
                        "<file name>",
                        "<file name>",
                        "<file name>"
                    ]
                },
                "<file name>",
                "<file name>",
                "<file name>"
            ]
        },
        {
            "<directory name>": [
                "<file name>",
                "<file name>",
                "<file name>"
            ]
        }
    ]
}

```

All the necessary data for creating such a data structure is contained in a specific URL. Example URL(s) from which to extract the new data structure:
```
34.8.32.234:48183/SvnRep/ADV-H5-New/README.txt
34.8.32.234:48183/SvnRep/ADV-H5-New/VisualSVN.lck
34.8.32.234:48183/SvnRep/ADV-H5-New/hooks-env.tmpl
34.8.32.234:48183/SvnRep/AT-APP/README.txt
34.8.32.234:48183/SvnRep/AT-APP/VisualSVN.lck
34.8.32.234:48183/SvnRep/AT-APP/hooks-env.tmpl
34.8.32.234:48183/SvnRep/README.txt
34.8.32.234:48183/SvnRep/VisualSVN.lck
34.8.32.234:48183/SvnRep/hooks-env.tmpl
34.8.32.234:48183/www/README.txt
34.8.32.234:48183/www/VisualSVN.lck
34.8.32.234:48183/www/hooks-env.tmpl```

```
An example of the end result should look like the following:
```json
{
    "34.8.32.234": [
        {
            "SvnRep": [
                {
                    "ADV-H5-New": [
                        "README.txt",
                        "VisualSVN.lck",
                        "hooks-env.tmpl"
                    ]
                },
                {
                    "AT-APP": [
                        "README.txt",
                        "VisualSVN.lck",
                        "hooks-env.tmpl"
                    ]
                },
                "README.txt",
                "VisualSVN.lck",
                "hooks-env.tmpl"
            ]
        },
        {
            "www": [
                "README.txt",
                "VisualSVN.lck",
                "hooks-env.tmpl"
            ]
        }
    ]
}

```
An important note is that the external endpoint returns a large dataset and has a delay of about ten seconds. In addition to data transformation, the end user should receive a response as quickly as possible. This means that it is necessary to create a mechanism that will ensure that the new /files endpoint does not have a significant delay in response time.
