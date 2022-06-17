<?php
switch (DISTRIX_ENV) {
  case DISTRIX_ENV_DEV:
    $host   = "unpwYzCr0FzJqw5nTxHLDB+xf/RmuTaxpk7vbssBqjI9AW9SmzEItMl/NC7d/B/kYF37rNYqzRncihXJ/pAbyw==";
    $user   = "6a4LUouHb3u2BM3ul+vKrrlehg+3GLBkR2UklQpOgz5yvX6wHc9Lh6p8JK0xwOqW65eHoNjDrPq7Y3mAN8H37Q==";
    $passBD = "6a4LUouHb3u2BM3ul+vKrrlehg+3GLBkR2UklQpOgz5yvX6wHc9Lh6p8JK0xwOqW65eHoNjDrPq7Y3mAN8H37Q==";
    $bdd    = "KX1PpMC9ojjRo1tHRVmtCg3ZkvIFnhq/hr4hF5lCZSpnyjn82DTLZ/JsAjrZd6d8BpFkL90mirpSnp6u1Rf8Zw==";
    break;
  case DISTRIX_ENV_VER:
    $host   = "eHnB3aAeZjCk/6M2KsPFJd9+3nEOFnUvm6nm0UoTZaSe+aB+Mu+//vbzTLHbyVuhkSmjBghibP5ouYGq73ww8dmOFzgQloEx+86hgooAuV8=";
    $user   = "KPbjJykPUPSlYF/s4ZN67JqApnyFJYlEkiegMMoO90+ZlxspiJKkEjod1iTZAOFhNFtXR6dvtfR3nlmE5IcFBQ==";
    $passBD = "gjcb3BcoGkUTjOMEGoV84Clt5CLFsr9UzRjJQgP7TBqLbOCpYw6qDMlRGfd3MmDI6mt+pglA97od0lW0cm4tLu4eH1OL4dP+RnKUoNLXEbg=";
    $bdd    = "8DcVsjRml8TNZo3XCWjZ+WSGmYIrgvM01JSHcA7dQXZhnblBMS6stENKLE6KVYB261PRp6xlk9IeDXL4QHNgCfSQF8LZOFZcSlCM/fWhcig=";
    break;
  case DISTRIX_ENV_VAL:
    $host   = "eHnB3aAeZjCk/6M2KsPFJd9+3nEOFnUvm6nm0UoTZaSe+aB+Mu+//vbzTLHbyVuhkSmjBghibP5ouYGq73ww8dmOFzgQloEx+86hgooAuV8=";
    $user   = "KPbjJykPUPSlYF/s4ZN67JqApnyFJYlEkiegMMoO90+ZlxspiJKkEjod1iTZAOFhNFtXR6dvtfR3nlmE5IcFBQ==";
    $passBD = "gjcb3BcoGkUTjOMEGoV84Clt5CLFsr9UzRjJQgP7TBqLbOCpYw6qDMlRGfd3MmDI6mt+pglA97od0lW0cm4tLu4eH1OL4dP+RnKUoNLXEbg=";
    $bdd    = "8DcVsjRml8TNZo3XCWjZ+WSGmYIrgvM01JSHcA7dQXZhnblBMS6stENKLE6KVYB261PRp6xlk9IeDXL4QHNgCfSQF8LZOFZcSlCM/fWhcig=";
    break;
  case DISTRIX_ENV_PROD:
    $host   = "eHnB3aAeZjCk/6M2KsPFJd9+3nEOFnUvm6nm0UoTZaSe+aB+Mu+//vbzTLHbyVuhkSmjBghibP5ouYGq73ww8dmOFzgQloEx+86hgooAuV8=";
    $user   = "KPbjJykPUPSlYF/s4ZN67JqApnyFJYlEkiegMMoO90+ZlxspiJKkEjod1iTZAOFhNFtXR6dvtfR3nlmE5IcFBQ==";
    $passBD = "gjcb3BcoGkUTjOMEGoV84Clt5CLFsr9UzRjJQgP7TBqLbOCpYw6qDMlRGfd3MmDI6mt+pglA97od0lW0cm4tLu4eH1OL4dP+RnKUoNLXEbg=";
    $bdd    = "8DcVsjRml8TNZo3XCWjZ+WSGmYIrgvM01JSHcA7dQXZhnblBMS6stENKLE6KVYB261PRp6xlk9IeDXL4QHNgCfSQF8LZOFZcSlCM/fWhcig=";
    break;
  default:
    break;
}
