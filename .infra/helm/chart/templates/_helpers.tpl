# main
{{- define "getReleaseName" -}}
  {{- .Release.Name | trunc 63 | trimSuffix "-" }}
{{- end }}

{{- define "getLabels" -}}
helm.sh/chart: {{- printf " %s-%s" .Values.app.name .Chart.Version | replace "+" "_" | trunc 63 | trimSuffix "-" }}
{{ include "getSelectorLabels" . }}
app.kubernetes.io/version: {{ .Chart.AppVersion | quote }}
app.kubernetes.io/managed-by: {{ .Release.Service }}
{{- end }}


{{- define "getSelectorLabels" -}}
app.kubernetes.io/name: {{ .Values.app.name  }}
app.kubernetes.io/instance: {{ include "getReleaseName" . }}
{{- end }}


{{- define "getServiceAccountName" -}}
{{- if .Values.serviceAccount.create }}
{{- default (include "chart.fullname" .) .Values.serviceAccount.name }}
{{- else }}
{{- default "default" .Values.serviceAccount.name }}
{{- end }}
{{- end }}


# redis service


{{- define "getRedisAppName" -}}
{{- include "getReleaseName" . -}}-redis-statefulset
{{- end }}

{{- define "getRedisPodName" -}}
  {{- include "getReleaseName" . -}}-redis-pod
{{- end }}

{{- define "getRedisHeadlessServiceName" -}}
  {{- include "getReleaseName" . -}}-redis-headless-svc
{{- end }}

{{- define "getRedisReadServiceName" -}}
  {{- include "getReleaseName" . -}}-redis-read-svc
{{- end }}

{{- define "getRedisHostMasterName" -}}
  {{- include "getRedisAppName" . -}}-0
{{- end }}

{{- define "getRedisHostMaster" -}}
  {{- include "getRedisHostMasterName" . -}}.{{- include "getRedisHeadlessServiceName" . -}}
{{- end }}
